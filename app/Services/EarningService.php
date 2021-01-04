<?php

namespace App\Services;

use App\Reseller;
use Carbon\Carbon;

class EarningService
{
    public $reseller;
    public $periods = [];
    public $timeFormat = 'd-M-Y';
    public $seperator = '--';
    public $orders;
    
    public $currentPeriod;
    public $nextTransactionPeriod;

    public function __construct($reseller)
    {
        $reseller instanceof Reseller || (
            $reseller = Reseller::findOrFail($reseller)
        );
        $periods = [];
        
        for ($year = $reseller->created_at->year, $i = 0; $year <= date('Y'); $year++, $i++) {
            for ($month = ($year == date('Y') ? $reseller->created_at->month : 1), $j = 0; $month <= ($year == date('Y') ? date('m') : 12); $month++, $j++) {
                $date = $reseller->created_at;
                $j && $date->firstOfMonth()->addMonths($j);

                $fOfMon = $date->copy()->firstOfMonth();
                $mOfMon = $fOfMon->copy()->addDays(14);
                $lOfMon = $date->copy()->lastOfMonth();

                $snapOne = $fOfMon->format($this->timeFormat);
                $snapTwo = $mOfMon->format($this->timeFormat);
                $snapThree = $mOfMon->addDay()->format($this->timeFormat);
                $snapFour = $lOfMon->format($this->timeFormat);

                // First Month
                if (! $j) {
                    $date->day <= 15 && ($periods[] = $snapOne . $this->seperator . $snapTwo);
                    $periods[] = $snapThree . $this->seperator . $snapFour;
                    continue;
                }

                // Current Month
                if ($date->month == date('m')) {
                    $periods[] = $snapOne . $this->seperator . $snapTwo;
                    date('d') > 15 && ($periods[] = $snapThree . $this->seperator . $snapFour);
                    continue;
                }

                $periods[] = $snapOne . $this->seperator . $snapTwo;
                $periods[] = $snapThree . $this->seperator . $snapFour;
            }
        }

        $this->periods = $periods;
        $this->reseller = $reseller;
        $this->currentPeriod = end($periods);
        $this->nextTransactionPeriod();
    }

    public function orders($period)
    {
        return $this->orders = $this->reseller->orders()
            ->where(function($query) use ($period) {
                list($start_date, $end_date) = explode($this->seperator, $period);
                $start_date = Carbon::parse($start_date);
                $end_date = Carbon::parse($end_date)->endOfDay();
        
                $query->whereBetween('data->completed_at', [$start_date, $end_date])
                ->orWhereBetween('data->returned_at', [$start_date, $end_date]);
            })
            ->orderBy('updated_at', 'asc')
            ->get();
    }

    public function completedOrders()
    {
        if (! $this->orders) {
            return null;
        }

        return $this->orders->filter(function ($order) {
            return $order->status == 'completed';
        });
    }

    public function returnedOrders()
    {
        if (! $this->orders) {
            return null;
        }

        return $this->orders->filter(function ($order) {
            return $order->status == 'returned';
        });
    }

    public function nextTransactionPeriod($currentPeriod = null)
    {
        $currentPeriod && (
            $this->currentPeriod = $currentPeriod
        );

        if (! $this->currentPeriod) {
            return null;
        }

        list($start_date, $end_date) = array_map(function ($date) {
            return Carbon::parse($date);
        }, explode($this->seperator, $this->currentPeriod));
        
        $fOfMon = $start_date->copy()->firstOfMonth();
        $mOfMon = $fOfMon->copy()->addDays(14);
        $lOfMon = $end_date->copy()->lastOfMonth();

        $fOfNextMon = $fOfMon->copy()->addMonth()->firstOfMonth();
        $mOfNextMon = $fOfNextMon->copy()->addDays(14);

        return $this->nextTransactionPeriod
            = $end_date->day > 15 ? [
                $fOfNextMon, $mOfNextMon->endOfDay(),
            ] : [
                $mOfMon->addDay(), $lOfMon->endOfDay(),
            ];
    }

    public function howPaid($currentPeriod = null)
    {
        $currentPeriod && (
            $this->nextTransactionPeriod($currentPeriod)
        );

        $transactions = $this->reseller->transactions()->status('paid')->whereBetween('updated_at', $this->nextTransactionPeriod)->get();
        return $transactions->isEmpty() ? null : $transactions->sum('amount');
    }
}
