<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceLogRequest;
use App\Models\ServiceAttachment;
use App\Models\ServiceLog;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ServiceBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id): View
    {
        $vehicle = Vehicle::where('id', $id)->firstOrFail();

        return view('admin.fleet.show', compact('vehicle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id): View
    {
        $vehicle = Vehicle::where('id', $id)->firstOrFail();

        return view('admin.fleet.service-book.create', compact('vehicle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceLogRequest $request): RedirectResponse
    {
        $counter = 0;
        $serviceLog = ServiceLog::create($request->except('_token'));

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $filename = $request->array('attachment-name')[$counter] ?? $attachment->getClientOriginalName();
                $hashedFilename = substr(md5(time() . $counter), 0, 8) . '-' . $filename;

                $attachment->storeAs('', $hashedFilename, 'service-book-attachments');

                ServiceAttachment::create([
                    'service_id' => $serviceLog->id,
                    'title' => $filename,
                    'path' => $hashedFilename,
                ]);

                $counter++;
            }
        }

        return to_route('service-book.index', ['vehicle' => $request->input('vehicle_id')])->with('success', 'Záznam do knihy byl vytvořen.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $vehicleId, string $serviceId): View
    {
        $vehicle = Vehicle::where('id', $vehicleId)->firstOrFail();
        $service = ServiceLog::where('id', $serviceId)->firstOrFail();

        return view('admin.fleet.service-book.edit', compact('vehicle', 'service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreServiceLogRequest $request, string $vehicleId, string $serviceId): RedirectResponse
    {
        $serviceLog = ServiceLog::where('id', $serviceId)->firstOrFail();

        $serviceLog->update($request->except(['_token', '_method']));

        if ($request->hasFile('attachments')) {
            $counter = 0;
            foreach ($request->file('attachments') as $attachment) {
                $filename = $request->array('attachment-name')[$counter] ?? $attachment->getClientOriginalName();
                $hashedFilename = substr(md5(time() . $counter), 0, 8) . '-' . $filename;

                $attachment->storeAs('', $hashedFilename, 'service-book-attachments');

                ServiceAttachment::create([
                    'service_id' => $serviceLog->id,
                    'title' => $filename,
                    'path' => $hashedFilename,
                ]);

                $counter++;
            }
        }

        return to_route('service-book.index', ['fleet' => $vehicleId])->with('success', 'Servisní záznam byl úspěšně aktualizován.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $vehicle, string $id): RedirectResponse
    {
        ServiceLog::where('id', $id)->delete();

        return to_route('service-book.index', ['fleet' => $vehicle])->with('success', 'Záznam byl smazán.');
    }

    public function serveAttachment(string $id): BinaryFileResponse
    {
        $attachment = ServiceAttachment::where('id', $id)->firstOrFail();

        $path = storage_path('app/service-book-attachments/'.$attachment->path);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
