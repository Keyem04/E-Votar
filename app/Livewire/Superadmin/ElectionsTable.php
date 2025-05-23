<?php

namespace App\Livewire\Superadmin;

use App\Exports\ElectionsExport;
use App\Models\Election;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class ElectionsTable extends Component
{
    use WithPagination;


    protected $listeners = [
        'echo:table-updates,TableUpdated' => 'refreshComponent',
    ];


    public $filter = 'all_elections';
    public $search = '';

    // Add debounce for search input (milliseconds)
    protected $queryString = [
        'search' => ['except' => '', 'as' => 'q'],
        'filter' => ['except' => 'all_elections']
    ];

    public $perPage = 10;


    public function refreshComponent()
    {
        Log::info('Livewire refresh triggered at: ' . now());
        $this->resetPage();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilter(): void
    {
        $this->resetPage();
    }

    public function exportElection()
    {
        return Excel::download(new ElectionsExport, 'LIST_OF_ELECTIONS.xlsx');

    }


    public function render()
    {
        Log::info('ElectionsTable rendered at: '.now());
        $query = Election::query()
            ->with('election_type')
            ->orderBy('created_at', 'desc');

        // Enhanced search functionality
        if ($this->search) {
            $query->where(function (Builder $query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('election_type', function (Builder $query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhere('date_started', 'like', '%' . $this->search . '%')
                    ->orWhere('date_ended', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->perPage === 'all') {
            return $query->get();
        }

        // Status filter
        if ($this->filter === 'ongoing_elections') {
            $query->where('status', 'ongoing');
        } elseif ($this->filter === 'completed_elections') {
            $query->where('status', 'completed');
        }elseif ($this->filter === 'pending_elections') {
            $query->where('status', 'pending');
        }

        $elections = $query->paginate($this->perPage);

        return view('evotar.livewire.superadmin.elections-table', [
            'elections' => $elections,
            'hasResults' => $elections->total() > 0,
        ]);
    }
}
