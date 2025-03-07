<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class SettingsIndex extends Component
{
    use WithFileUploads;

    public $name, $title, $subtitle, $email;
    public $logo, $video, $phone, $description;
    public $extract, $executives = [], $socialLinks = [];
    public $newExecutive = ['name' => '', 'position' => '', 'photo' => null,];
    public $logoUrl;
    public $videoUrl;
    public $settingId;
    public $showExecutiveForm = false;

    public function mount()
    {
        $this->loadSettings();
    }
    private function loadSettings()
    {
        $settings = Setting::first();
        if ($settings) {
            $this->settingId = $settings->id;
            $this->name = $settings->name;
            $this->title = $settings->title;
            $this->subtitle = $settings->subtitle;
            $this->phone = $settings->phone;
            $this->email = $settings->email;
            $this->extract = $settings->extract;
            $this->description = $settings->description;
            $this->socialLinks = $settings->social_links ?? [];
            $this->executives = $settings->executives ?? [];
            $this->logoUrl = $settings->logo ? Storage::url($settings->logo) : null;
            $this->videoUrl = $settings->video ? Storage::url($settings->video) : null;
            $this->extract = $settings->extract;
        }
    }
    public function addExecutive()
    {
        $this->validate([
            'newExecutive.name' => 'required|string|max:255',
            'newExecutive.position' => 'required|string|max:255',
            'newExecutive.photo' => 'nullable|image|max:1024',
        ]);

        $photoPath = null;
        if ($this->newExecutive['photo']) {
            // Genera un nombre único para la imagen
            $filename = Str::random(20) . '.' . $this->newExecutive['photo']->getClientOriginalExtension();
            $photoPath = $this->newExecutive['photo']->storeAs('executives', $filename, 'public');
        }

        $this->executives[] = [
            'name' => $this->newExecutive['name'],
            'position' => $this->newExecutive['position'],
            'photo' => $photoPath ? 'executives/' . $filename : null, // Guarda la ruta relativa en la DB
        ];

        // $this->countExecutives ++;
    }
    public function removeExecutive($index)
    {
        unset($this->executives[$index]);
        $this->executives = array_values($this->executives);
    }
    public function save()
    {
        // Validar los datos generales
        $this->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'logo' => 'required|image|max:1024',
            'extract' => 'required|string',
            'phone' => 'required|digits_between:1,20',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
            'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:512000|not_in:forbidden_video.mp4',
        ]);

        try {
            $data = [
                'name' => $this->name,
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'extract' => $this->extract,
                'social_links' => $this->socialLinks,
                'phone' => $this->phone,
                'email' => $this->email,
                'description' => $this->description,
                'executives' => $this->executives,
            ];

            // Guardar el logo si se ha subido
            if ($this->logo) {
                $data['logo'] = $this->logo->store('logos', 'public');
                $this->logoUrl = Storage::url($data['logo']); // Actualizar la URL del logo
            }

            if ($this->video) {
                $videoPath = $this->video->store('videos', 'public');
                $data['video'] = $videoPath;
                $this->videoUrl = Storage::url($videoPath);
            }

            $this->settingId ? $this->updateSetting($data) : $this->createSetting($data);
            session()->flash('message', 'Configuración guardada exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Ocurrió un error al guardar la configuración: ' . $e->getMessage());
        }
    }
    private function createSetting(array $data)
    {
        $setting = Setting::create($data);
        $this->settingId = $setting->id;
    }
    private function updateSetting(array $data)
    {
        $setting = Setting::find($this->settingId);
        $setting->update($data);
    }

    public function delete()
    {
        if ($this->settingId) {
            Setting::find($this->settingId)->delete();
            $this->resetForm();
            session()->flash('message', 'Configuración eliminada correctamente.');
        }
    }
    public function resetNewExecutive()
    {
        $this->newExecutive = ['name' => '', 'position' => '', 'photo' => null];
    }
    private function resetForm()
    {
        $this->reset(['name','logo','title','subtitle','executives','socialLinks','phone','email','description','video','settingId','newExecutive']);
    }
    public function render()
    {
        return view('livewire.admin.settings-index');
    }
}
