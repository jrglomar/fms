<style>
.breadcrumb-item+.breadcrumb-item::before {
    content: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxwYXRoIGQ9Ik0yLjUgMEwxIDEuNSAzLjUgNCAxIDYuNSAyLjUgOGw0LTQtNC00eiIgZmlsbD0iY3VycmVudENvbG9yIi8+PC9zdmc+);
}
</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            SRD Management
        </li>
        <li class="breadcrumb-item">
            SRD
        </li>
        <li class="breadcrumb-item" id="faculty_requirement_bin">
        <a href="/faculty/requirement_bin">Requirement Bins</a>
            <script>
                if(window.location.pathname == '/faculty/requirement_bin')
                {
                    document.getElementById("faculty_requirement_bin").classList.add('active');
                    document.getElementById("faculty_requirement_bin").setAttribute("aria-current", "page")
                }
            </script>
        </li>
        <li class="breadcrumb-item" id="faculty_requirement_list_type">
        <a href="javascript:window.location.reload();">Bin Details</a>
            <script>
                if(window.location.pathname == '/faculty/activity')
                {
                    document.getElementById("faculty_requirement_list_type").classList.add('active');
                    document.getElementById("faculty_requirement_list_type").setAttribute("aria-current", "page")
                }
            </script>
        </li>
    </ol>
</nav>