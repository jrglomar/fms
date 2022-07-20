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
        <li class="breadcrumb-item" id="admin_role">
        <a href="/admin/role">Role</a>
            <script>
                if(window.location.pathname == '/admin/role')
                {
                    document.getElementById("admin_role").classList.add('active');
                    document.getElementById("admin_role").setAttribute("aria-current", "page")
                }
            </script>
        </li>
    </ol>
</nav>