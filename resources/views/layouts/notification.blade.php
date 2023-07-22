 <div class="dropdown-menu dropdown-list dropdown-menu-right ">
     <div class="dropdown-header bg-light dark:bg-white dark:bg-opacity-10"><strong>You have
             {{ $notifications->count() }}
             messages</strong></div>
     {{-- message notify --}}
     @foreach ($notifications as $notification)
         <a class="dropdown-item" href="{{ route('notifications.show', ['id' => $notification->id]) }}">
             <div class="message">
                 <div class="text-truncate font-weight-bold">{{ $notification->title }}</div>
                 <div class="small text-medium-emphasis text-truncate">{{ $notification->message }}</div>
             </div>
         </a>
     @endforeach

     {{--  --}}
     <a class="dropdown-item text-center border-top" href="#"><strong>View all
             messages</strong></a>
 </div>
