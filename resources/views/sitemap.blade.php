{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ route('home') }}</loc>
        <lastmod>2026-10-19</lastmod>
    </url>

    <url>
        <loc>{{ route('template') }}</loc>
        <lastmod>2026-10-19</lastmod>
    </url>

    <url>
        <loc>{{ route('contact') }}</loc>
        <lastmod>2026-10-19</lastmod>
    </url>

    <url>
        <loc>{{ route('mentions-legales') }}</loc>
        <lastmod>2026-10-19</lastmod>
    </url>

    <url>
        <loc>{{ route('politique-confidentialite') }}</loc>
        <lastmod>2026-10-19</lastmod>
    </url>

    <url>
        <loc>{{ route('cgv') }}</loc>
        <lastmod>2026-10-19</lastmod>
    </url>

    @foreach ($templates as $template)
        <url>
            <loc>{{ route('detail-template', $template->slug) }}</loc>
            <lastmod>{{ $template->updated_at->toAtomString() }}</lastmod>
        </url>
    @endforeach

</urlset>
