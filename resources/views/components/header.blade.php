<div class="page-header">
    @include('components.header.search')
    <nav class="navbar navbar-default">
        @include('components.header.navbar')
        <div class="header-right pull-right">
            <ul class="list-inline justify-content-end">
                @include('components.header.languages')
                @include('components.header.notifications')
                @include('components.header.messages')
                @include('components.header.profile')
            </ul>
        </div>
    </nav>
</div>
