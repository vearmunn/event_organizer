<h1>Events</h1>

<a href="{{ route('events.create') }}">Create Event</a>

@foreach ($events as $event)
    <div>
        <h3>{{ $event->title }}</h3>
        <p>{{ $event->date }}</p>
        <a href="{{ route('events.show', $event->id) }}">View</a>
    </div>
@endforeach