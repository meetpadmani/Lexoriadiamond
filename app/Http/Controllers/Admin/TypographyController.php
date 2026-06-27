<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypographySetting;
use Illuminate\Http\Request;

class TypographyController extends Controller
{
    private $headingFonts = [
        'Playfair Display' => 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap',
        'Cormorant Garamond' => 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap',
        'Cinzel' => 'https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&display=swap',
        'Bodoni Moda' => 'https://fonts.googleapis.com/css2?family=Bodoni+Moda:wght@400;500;600;700&display=swap',
        'Marcellus' => 'https://fonts.googleapis.com/css2?family=Marcellus&display=swap',
        'Libre Baskerville' => 'https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap',
        'Prata' => 'https://fonts.googleapis.com/css2?family=Prata&display=swap',
    ];

    private $bodyFonts = [
        'Poppins' => 'https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap',
        'Montserrat' => 'https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600&display=swap',
        'Lato' => 'https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap',
        'Raleway' => 'https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600&display=swap',
        'Tenor Sans' => 'https://fonts.googleapis.com/css2?family=Tenor+Sans&display=swap',
        'Inter' => 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap',
    ];

    public function index()
    {
        $settings = TypographySetting::firstOrCreate(
            ['id' => 1],
            [
                'heading_font_family' => 'Playfair Display',
                'heading_font_url' => $this->headingFonts['Playfair Display'],
                'body_font_family' => 'Poppins',
                'body_font_url' => $this->bodyFonts['Poppins'],
                'accent_color' => '#c7a17a'
            ]
        );

        $headingFonts = array_keys($this->headingFonts);
        $bodyFonts = array_keys($this->bodyFonts);

        return view('admin.typography.index', compact('settings', 'headingFonts', 'bodyFonts'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'heading_font_family' => 'required|string',
            'body_font_family' => 'required|string',
            'accent_color' => 'required|string|max:7',
        ]);

        $data = [
            'heading_font_family' => $validated['heading_font_family'],
            'heading_font_url' => $this->headingFonts[$validated['heading_font_family']] ?? null,
            'body_font_family' => $validated['body_font_family'],
            'body_font_url' => $this->bodyFonts[$validated['body_font_family']] ?? null,
            'accent_color' => $validated['accent_color'],
        ];

        TypographySetting::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', 'Masterpiece aesthetics updated!');
    }
}
