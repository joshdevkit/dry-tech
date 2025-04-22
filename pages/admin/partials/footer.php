</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const sidebarCollapse = document.getElementById('sidebarCollapse');
        const showSidebar = document.getElementById('showSidebar');

        if (sidebarCollapse) {
            sidebarCollapse.addEventListener('click', function() {
                sidebar.classList.toggle('sidebar-collapsed');
                mainContent.classList.toggle('main-expanded');
            });
        }

        if (showSidebar) {
            showSidebar.addEventListener('click', function() {
                sidebar.classList.add('show');
            });
        }

        document.addEventListener('click', function(event) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnShowSidebar = showSidebar ? showSidebar.contains(event.target) : false;

            if (!isClickInsideSidebar && !isClickOnShowSidebar && window.innerWidth < 768) {
                sidebar.classList.remove('show');
            }
        });

        // Responsive behavior
        function handleResize() {
            if (window.innerWidth < 768) {
                sidebar.classList.remove('sidebar-collapsed');
                mainContent.classList.remove('main-expanded');
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize();

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

<script>
    new DataTable('#dataTable', {
        ordering: false
    });
</script>

</body>

</html>