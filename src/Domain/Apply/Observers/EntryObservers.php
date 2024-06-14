<?php

namespace Domain\Apply\Observers;

use Domain\Apply\Mail\EntryApplySendMail;
use Domain\Apply\Models\Entry;
use Illuminate\Support\Facades\Mail;

class EntryObservers
{
    public function creating(Entry $entry): void
    {
		 Mail::to($entry->email)
            ->queue(new EntryApplySendMail($entry));
    }

    /**
     * Handle the model "updating" event.
     *
     * @param  Domain\Apply\Models  $entry
     * @return void
     */
    public function updating(Entry $entry)
    {
    }

    /**
     * Handle the model "restored" event.
     *
     * @param  Domain\Apply\Models  $entry
     * @return void
     */
    public function restored(Entry $entry)
    {
    }

    /**
     * Handle the model "forceDeleted" event.
     *
     * @param  Domain\Apply\Models  $entry
     * @return void
     */
    public function forceDeleted(Entry $entry)
    {
    }
}
