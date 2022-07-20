<style>
.breadcrumb-item+.breadcrumb-item::before {
    content: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxwYXRoIGQ9Ik0yLjUgMEwxIDEuNSAzLjUgNCAxIDYuNSAyLjUgOGw0LTQtNC00eiIgZmlsbD0iY3VycmVudENvbG9yIi8+PC9zdmc+);
}
</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            System Setup
        </li>
        <li class="breadcrumb-item">
            Account
        </li>
        <li class="breadcrumb-item" id="admin_faculty_type">
        <a href="/admin/faculty_type">Faculty Type</a>
            <script>
                if(window.location.pathname == '/admin/faculty_type')
                {
                    document.getElementById("admin_faculty_type").classList.add('active');
                    document.getElementById("admin_faculty_type").setAttribute("aria-current", "page")
                }
            </script>
        </li>
    </ol>
</nav>