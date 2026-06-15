{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}

<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ route('home') }}</loc>
    </url>

    <url>
        <loc>{{ route('template') }}</loc>
    </url>

    <url>
        <loc>{{ route('contact') }}</loc>
    </url>

    <url>
        <loc>{{ route('mentions-legales') }}</loc>
    </url>

    <url>
        <loc>{{ route('politique-confidentialite') }}</loc>
    </url>

    <url>
        <loc>{{ route('cgv') }}</loc>
    </url>

    @foreach($templates as $template)
        <url>
            <loc>
                {{ route('detail-template', $template->slug) }}
            </loc>
        </url>
    @endforeach

</urlset>