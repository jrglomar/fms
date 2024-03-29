<style>
.breadcrumb-item+.breadcrumb-item::before {
    content: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxwYXRoIGQ9Ik0yLjUgMEwxIDEuNSAzLjUgNCAxIDYuNSAyLjUgOGw0LTQtNC00eiIgZmlsbD0iY3VycmVudENvbG9yIi8+PC9zdmc+);
}
</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: #FFFFFF; padding-left: 0px; margin-bottom: 0px">
        <li class="breadcrumb-item">
            Account Management
        </li>
        <li class="breadcrumb-item">
            Account
        </li>
        <li class="breadcrumb-item" id="acad_head_user">
        <a href="/acad_head/user">User</a>
            <script>
                if(window.location.pathname == '/acad_head/user')
                {
                    document.getElementById("acad_head_user").classList.add('active');
                    document.getElementById("acad_head_user").setAttribute("aria-current", "page")
                }
            </script>
        </li>
        <li class="breadcrumb-item" id="acad_head_user_profile">
        <a href="javascript:window.location.reload();">User Profile</a>
            <script>
                if(window.location.pathname == '/acad_head/user')
                {
                    document.getElementById("acad_head_user_profile").classList.add('active');
                    document.getElementById("acad_head_user_profile").setAttribute("aria-current", "page")
                }
            </script>
        </li>
    </ol>
</nav>