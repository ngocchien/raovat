var Category = {
    index: function () {
        $(document).ready(function () {
            $('.change-location').on('change', function () {
                var location = $(this).val();
                window.location.href = location;
            });
        });
    }
};
