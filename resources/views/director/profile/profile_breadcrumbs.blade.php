<style>
.breadcrumb-item+.breadcrumb-item::before {
    content: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxwYXRoIGQ9Ik0yLjUgMEwxIDEuNSAzLjUgNCAxIDYuNSAyLjUgOGw0LTQtNC00eiIgZmlsbD0iY3VycmVudENvbG9yIi8+PC9zdmc+);
}
</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: #FFFFFF; padding-left: 0px; margin-bottom: 0px">
        <li class="breadcrumb-item">
            Dashboard
        </li>
        <li class="breadcrumb-item" id="director_profile">
        <a href="javascript:window.location.reload();">Profile</a>
            <script>
                if(window.location.pathname == '/director/profile')
                {
                    document.getElementById("director_profile").classList.add('active');
                    document.getElementById("director_profile").setAttribute("aria-current", "page")
                }
            </script>
        </li>
        <li class="breadcrumb-item">
            User Details
        </li>
    </ol>
</nav>