<x-mail::message>
# Welcome to Job Linker!

Congratulations on subscribing to our service! We're excited to have you on board.

## Purchase Details:
- **Plan:** {{ $plan }}
- **Billing Ends On:** {{ $billingEnds }}

With your subscription, you now have access to all our job listings and premium features. Start exploring and make the most of your subscription.

<x-mail::button :url="''">
Post a Job
</x-mail::button>

If you have any questions or need assistance, feel free to reach out to our support team.

Thanks for choosing {{ config('app.name') }}!

Best Regards,<br>
The {{ config('app.name') }} Team
</x-mail::message>