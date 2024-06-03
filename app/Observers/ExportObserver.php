<?php

namespace App\Observers;

use App\Models\Export;
use Illuminate\Support\Facades\Storage;

class ExportObserver
{
    /**
     * Handle the Export "created" event.
     */
    public function created(Export $export): void
    {
        //
    }

    /**
     * Handle the Export "updated" event.
     */
    public function updated(Export $export): void
    {
        //
    }

    /**
     * Handle the Export "deleted" event.
     */
    public function deleted(Export $export): void
    {
        if (!is_null($export->file_name)) {
            Storage::disk('public')->deleteDirectory('filament_exports/' . $export->id);
        }
    }

    /**
     * Handle the Export "restored" event.
     */
    public function restored(Export $export): void
    {
        //
    }

    /**
     * Handle the Export "force deleted" event.
     */
    public function forceDeleted(Export $export): void
    {
        if (!is_null($export->file_name)) {
            Storage::disk('public')->deleteDirectory('filament_exports/' . $export->id);
        }
    }
}
