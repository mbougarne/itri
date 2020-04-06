<script>
    iziToast.info({
        title: '{{ __("$title") }}',
        message: '{{ __("$message") }}',
        position: 'topRight',
        theme: 'light', // dark
        color: '{{ $color }}', // blue, red, green, yellow
        icon: '{{ $icon }}',
    });
</script>
