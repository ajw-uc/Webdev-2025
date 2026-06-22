<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\Route;


class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create();

        // Mengambil semua route yang ada di Laravel
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            // Hanya ambil route bertipe GET dan tanpa parameter (seperti {id})
            if (in_array('GET', $route->methods()) && !str_contains($route->uri(), '{')) {
                // Hindari route berbasis API
                if (!str_starts_with($route->uri(), 'api/')) {
                    $sitemap->add(
                        Url::create(url($route->uri()))
                            ->setLastModificationDate(now())
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                            ->setPriority(0.8)
                    );
                }
            }
        }

        // Simpan sitemap ke direktori public
        $sitemap->writeToFile(public_path('sitemap.xml'));

        // Tampilkan sebagai response XML
        return response()->file(public_path('sitemap.xml'));
    }
}
