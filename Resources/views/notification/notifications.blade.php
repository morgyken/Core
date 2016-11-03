<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-bell-o"></i>
        <span class="label label-success notificationsCounter animated ">{{ $notifications->count() }}</span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <div class="slimScrollDiv">
                <ul class="menu notifications-list">
                    @if($notifications->count() === 0)
                    <li class="noNotifications">
                        <a href="#">
                            No new notifications for you.
                        </a>
                    </li>
                    @endif
                    @foreach ($notifications as $notification)
                    <li>
                        <a href="{{ $notification->link }}">
                            <div class="pull-left notificationIcon">
                                <i class="fa fa-{{ $notification->icon_class }}"></i>
                            </div>
                            <h4>
                                {{ $notification->title }}
                                <small>
                                    <i class="fa fa-clock-o"></i> {{ $notification->time_ago }}
                                    <i class="fa fa-close removeNotification" data-id="{{ $notification->id }}"></i>
                                </small>
                            </h4>
                            <p>{{ $notification->message }}</p>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </li>
        <li class="footer"><a href="{{ route('system.notification.index') }}">View all notifications</a></li>
    </ul>
</li>

<script>
    $(document).ready(function () {
        $('.removeNotification').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var self = this;
            $.ajax({
                type: 'POST',
                url: "{{ route('api.system.mark-read') }}",
                data: {
                    'id': $(this).data('id'),
                    '_token': '{{ csrf_token() }}'
                },
                success: function (data) {
                    if (data.updated) {
                        var notification = $(self).closest('li');
                        notification.addClass('animated fadeOut');
                        setTimeout(function () {
                            notification.remove();
                        }, 510);
                        var count = parseInt($('.notificationsCounter').text());
                        $('.notificationsCounter').text(count - 1);
                    }
                }
            });
        });
    });
</script>
