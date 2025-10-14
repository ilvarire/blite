<x-mail::message>
    # New Service Booking

    Dear admin,
    A new service booking was made:

    **Name:** {{ $message->name }}
    **Email:** {{ $message->email }}
    **Number:** {{ $message->phone_number }}
    **No of Guests:** {{ $message->people }}
    **Date:** {{ $message->date }}
    **Time:** {{ $message->time }}

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>