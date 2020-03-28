<footer class="app-footer">
    @php $rand = mt_rand(1, 2) @endphp
    <div class="@if($rand == 1) d-none d-sm-block @endif mx-auto">
        <span>Developed By</span>
        <a href="https://cyber32.com">Cyber32</a>
    </div>
    <div class="@if($rand == 2) d-none d-sm-block @endif mx-auto">
        <span>Powered by</span>
        <a href="https://HotashPathshala.com">HotashPathshala</a>
    </div>
</footer>