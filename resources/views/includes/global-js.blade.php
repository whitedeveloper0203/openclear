<script>
    var csrf_token = "{{ csrf_token() }}";
    var siteUrl = "{{ url('/') }}";
    var userId = null;
</script>

@if(!auth()->guest())
    <script>
        userId = <?php echo Auth::user()->id; ?>;
    </script>
@endif
