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



    public function updating(Entry $entry)
    {
    }


    public function restored(Entry $entry)
    {
    }


    public function forceDeleted(Entry $entry)
    {
    }
}
