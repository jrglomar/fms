<style>
.breadcrumb-item+.breadcrumb-item::before {
    content: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxwYXRoIGQ9Ik0yLjUgMEwxIDEuNSAzLjUgNCAxIDYuNSAyLjUgOGw0LTQtNC00eiIgZmlsbD0iY3VycmVudENvbG9yIi8+PC9zdmc+);
}
</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            Meeting Management
        </li>
        <li class="breadcrumb-item">
            Meeting
        </li>
        <li class="breadcrumb-item" id="faculty_meeting">
        <a href="/faculty/meeting">Meetings</a>
            <script>
                if(window.location.pathname == '/faculty/meeting')
                {
                    document.getElementById("faculty_meeting").classList.add('active');
                    document.getElementById("faculty_meeting").setAttribute("aria-current", "page")
                }
            </script>
        </li>
    </ol>
</nav>