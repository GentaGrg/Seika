<div>
    <!-- Your HTML and styling for the OAuth button goes here -->
    <!-- Example: -->
    <a href="{{ route('oauth.redirect', ['provider' => $provider]) }}">
        {{ ucfirst($provider) }} Login
    </a>
</div>
