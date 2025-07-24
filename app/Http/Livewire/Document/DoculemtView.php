<?php

namespace App\Http\Livewire\Document;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Resource as Document;
use Illuminate\Support\Facades\Storage;
use App\Models\Lender;

class DoculemtView extends Component
{



    use WithFileUploads, WithPagination;

    public $isOpen = false;
    public $showDeleteModal = false;
    public $documentId;
    public $searchTerm = '';
    public $editMode = false;

    // Document properties
    public $name;
    public $path_url;
    public $descriptions;
    public $lender_id;
    public $status;
    public $document; // For file uploads

    protected $paginationTheme = 'tailwind';

    protected $rules = [
        'name' => 'required|string|max:300',
        'descriptions' => 'nullable|string|max:500',
        'lender_id' => 'nullable|string|max:20',
        'status' => 'required|in:Active,Inactive',
    ];

    protected $validationAttributes = [
        'name' => 'document name',
        'descriptions' => 'description',
        'lender_id' => 'lender ID',
        'status' => 'status',
    ];

    public function render()
    {
        $search = $this->searchTerm;

        // Search lenders separately (for dropdown, suggestions, etc.)
        $lenders = [];
        if (strlen($search) >= 2) {
            $lenders = Lender::where('name', 'like', '%' . $search . '%')
                ->orderBy('name')
                ->limit(10)
                ->get();
        }

        // Search documents along with lender name
        $documents = Document::query()->with('lender') // assuming a Document belongsTo Lender
            ->where(function ($query) use ($search) {
                $query->where('resources.name', 'like', '%' . $search . '%')
                    ->orWhere('resources.descriptions', 'like', '%' . $search . '%')
                    ->orWhereHas('lender', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });


            if(auth()->user()->department == 2) {
                $documents = $documents->where('lender_id', auth()->user()->institution_id);
            }

            $documents ->orderBy('resources.id', 'desc')
            ->get();

        // Document stats
        $totalDocuments = Document::count();
        $activeDocuments = Document::where('status', 'Active')->count();
        $inactiveDocuments = Document::where('status', 'Inactive')->count();

        return view('livewire.document.doculemt-view', [
            'documents' => $documents,
            'totalDocuments' => $totalDocuments,
            'activeDocuments' => $activeDocuments,
            'inactiveDocuments' => $inactiveDocuments,
            'lenders' => $lenders,
        ]);
    }


    public function resetInputFields()
    {
        $this->reset(['name', 'path_url', 'descriptions', 'lender_id', 'status', 'document']);
        $this->resetErrorBag();
    }

    public function createDocument()
    {
        $this->resetInputFields();
        $this->editMode = false;
        $this->status = 'Active'; // Default value
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->editMode) {
            // Update existing document
            $document = Document::find($this->documentId);

            if ($document) {
                // Handle file upload if a new file is selected
                if ($this->document) {
                    $this->validate([
                        'document' => 'required|file|max:10240', // 10MB max
                    ]);

                    // Delete old file if it exists
                    if ($document->path_url && Storage::exists('public/documents/' . $document->path_url)) {
                        Storage::delete('public/documents/' . $document->path_url);
                    }

                    // Store new file
                    $fileName = time() . '_' . $this->document->getClientOriginalName();
                    $this->document->storeAs('public/documents', $fileName);
                    $validatedData['path_url'] = $fileName;
                }

                $document->update($validatedData);
                session()->flash('message', 'Document updated successfully!');
            } else {
                session()->flash('error', 'Document not found!');
            }
        } else {
            // Create new document
            $this->validate([
                'document' => 'required|file|max:10240', // 10MB max
            ]);

            // Store file
            $fileName = time() . '_' . $this->document->getClientOriginalName();
            $this->document->storeAs('public/documents', $fileName);

            $validatedData['path_url'] = $fileName;
            $validatedData['lender_id']= auth()->user()->institution_id;

            Document::create($validatedData);
            session()->flash('message', 'Document added successfully!');
        }

        $this->closeModal();
        $this->resetInputFields();
    }

    public function editDocument($id)
    {
        $document = Document::findOrFail($id);

        $this->documentId = $document->id;
        $this->name = $document->name;
        $this->path_url = $document->path_url;
        $this->descriptions = $document->descriptions;
        $this->lender_id = $document->lender_id;
        $this->status = $document->status;

        $this->editMode = true;
        $this->openModal();
    }

    public function deleteConfirmation($id)
    {
        $this->documentId = $id;
        $this->showDeleteModal = true;
    }

    public function deleteDocument()
    {
        $document = Document::find($this->documentId);

        if ($document) {
            // Delete file from storage if it exists
            if ($document->path_url && Storage::exists('public/documents/' . $document->path_url)) {
                Storage::delete('public/documents/' . $document->path_url);
            }

            $document->delete();
            session()->flash('message', 'Document deleted successfully!');
        } else {
            session()->flash('error', 'Document not found!');
        }

        $this->showDeleteModal = false;
    }

    public function downloadDocument($id)
    {

        $document = Document::find($id);

        if ($document && $document->path_url && Storage::disk('public')->exists('documents/' . $document->path_url)) {
            return Storage::disk('public')->download('documents/' . $document->path_url, $document->name);
        }

        session()->flash('error', 'Document file not found!');
        return redirect()->back();
    }







}
