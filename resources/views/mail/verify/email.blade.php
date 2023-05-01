<div style="max-width: 500px; margin: 0 auto; text-align: center;">
    <div style="text-align: center;">
        <img src="https://res.cloudinary.com/dfbz33tyh/image/upload/v1682953105/statistics_klw43p.png"
            alt="coronaStatistics" style="max-width: 100%; height: auto;">
        <h1 style="font-size: 24px; margin-top: 40px; font-weight: 900; color:black;">
            {{ __('email/verify.confirmation') }}</h1>
    </div>
    <p style="font-size: 16px; color:black; font-weight: 400; margin-top: 12px; margin-bottom: 30px;">
        {{ __('email/verify.reference') }}</p>
    <a href="{{ $url }}"
        style="background-color: #0FBA68; color: #fff; font-weight:900; display: inline-block; padding:20px 24px; font-size: 16px; text-decoration: none; border-radius: 10px;width:100%; max-width: 400px; box-sizing: border-box;">{{ __('email/verify.verify') }}</a>
</div>
