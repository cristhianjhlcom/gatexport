@props([
    'title' => config('app.name'),
    'description' => ($general_information['translations']['company_short_description'] ??= ''),
    'author' => config('app.name'),
    'robots' => 'index, follow',
    'lang' => app()->getLocale(),
    'canonical' => url()->current(),
    'type' => 'article',
    'image' => ($company_logos['large_logo'] ??= asset('default-thumbnail.jpg')),
    'siteName' => config('app.name'),
    'twitterSite' => '@gatexport',
    'twitterCreator' => '@gatexport',
    'themeColor' => '#923d10',
])

<title>{{ $title }} | Gate Export SAC</title>
<meta content="{{ $description }}" name="description">
<meta content="{{ $robots }}" name="robots">
<meta content="{{ $author }}" name="author">
<meta content="{{ $lang }}" http-equiv="Content-Language">
<link href="{{ $canonical }}" rel="canonical">

{{-- OG Content --}}
<meta content="{{ $type }}" property="og:type">
<meta content="{{ $title }}" property="og:title">
<meta content="{{ $description }}" property="og:description">
<meta content="{{ $image }}" property="og:image">
<meta content="{{ $canonical }}" property="og:url">
<meta content="{{ $siteName }}" property="og:site_name">
<meta content="{{ $lang }}" property="og:locale">

{{-- Twitter Content --}}
<meta content="summary_large_image" name="twitter:card">
<meta content="{{ $title }}" name="twitter:title">
<meta content="{{ $description }}" name="twitter:description">
<meta content="{{ $image }}" name="twitter:image">
<meta content="{{ $twitterSite }}" name="twitter:site">
<meta content="{{ $twitterCreator }}" name="twitter:creator">

<meta content="{{ $themeColor }}" name="theme-color">
