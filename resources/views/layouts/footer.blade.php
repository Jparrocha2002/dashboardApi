<script>
    function confirmLogout() {
    if (confirm('Are you sure you want to logout?')) {
        localStorage.removeItem("token");

        window.location.href = '/';
    }
}

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>