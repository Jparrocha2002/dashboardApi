<script>
    function confirmLogout() {
        swal({
        title: "Logout Confirmation",
        text: "Are you sure you want to logout?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if(willDelete){
                localStorage.removeItem('token');
                window.location.href = '/';
            }
        });
}

</script>
<script src="{{ asset('bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('sweetalert.min.js') }}"></script>
</body>
</html>