<style>
.breadcrumb-item+.breadcrumb-item::before {
    content: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxwYXRoIGQ9Ik0yLjUgMEwxIDEuNSAzLjUgNCAxIDYuNSAyLjUgOGw0LTQtNC00eiIgZmlsbD0iY3VycmVudENvbG9yIi8+PC9zdmc+);
}
</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: #FFFFFF; padding-left: 0px; margin-bottom: 0px">
        <li class="breadcrumb-item">
            System Setup
        </li>
        <li class="breadcrumb-item">
            Activity
        </li>
        <li class="breadcrumb-item" id="admin_activity_type">
        <a href="/admin/activity_type">Activity Type</a>
            <script>
                if(window.location.pathname == '/admin/activity_type')
                {
                    document.getElementById("admin_activity_type").classList.add('active');
                    document.getElementById("admin_activity_type").setAttribute("aria-current", "page")
                }
            </script>
        </li>
    </ol>
</nav>