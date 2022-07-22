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
            Meeting
        </li>
        <li class="breadcrumb-item" id="admin_meeting_type">
        <a href="/admin/meeting_type">Meeting Type</a>
            <script>
                if(window.location.pathname == '/admin/meeting_type')
                {
                    document.getElementById("admin_meeting_type").classList.add('active');
                    document.getElementById("admin_meeting_type").setAttribute("aria-current", "page")
                }
            </script>
        </li>
    </ol>
</nav>