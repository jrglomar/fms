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
        <li class="breadcrumb-item" id="acad_head_activity">
        <a href="/acad_head/meeting">Meetings</a>
            <script>
                if(window.location.pathname == '/acad_head/meeting')
                {
                    document.getElementById("acad_head_meeting_view").classList.add('active');
                    document.getElementById("acad_head_meeting_view").setAttribute("aria-current", "page")
                }
            </script>
        </li>
        <li class="breadcrumb-item" id="acad_head_view_meeting_view">
        <a href="javascript:window.location.reload();">Meeting Details</a>
            <script>
                if(window.location.pathname == '/acad_head/meeting')
                {
                    document.getElementById("acad_head_view_meeting_view").classList.add('active');
                    document.getElementById("acad_head_view_meeting_view").setAttribute("aria-current", "page")
                }
            </script>
        </li>
    </ol>
</nav>