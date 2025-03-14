<?php

namespace App\Livewire\Admin;

use App\Http\Requests\SettingsRequest;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class SettingsIndex extends Component
{
    use WithFileUploads;

    public $name, $title, $subtitle, $email;
    public $logo, $video, $phone, $description,$image, $address, $phrase, $video_img;
    public $extract, $executives = [], $socialLinks = [];
    public $newExecutive = ['name' => '', 'position' => '', 'photo' => null,];
    public $logoUrl;
    public $videoUrl;
    public $videoPath;
    public $settingId;
    public $imagePath;
    public $showExecutiveForm = false;

    protected $settingService;
    

    public function __construct()
    {
        $this->settingService = new SettingService;
    }
    protected function rules(){
        $settingsRequest = new SettingsRequest();
        return $settingsRequest->rules();
    }
    protected function messages()
    {
        $settingsRequest = new SettingsRequest();
        return $settingsRequest->messages();
    }
    public function mount()
    {
        $this->loadSettings();
    }
    private function loadSettings()
    {
        $settings = $this->settingService->getAllSettings();
        if ($settings) {
            $this->settingId = $settings->id;
            $this->name = $settings->name;
            $this->title = $settings->title;
            $this->subtitle = $settings->subtitle;
            $this->address = $settings->address;
            $this->phrase = $settings->phrase;
            $this->phone = $settings->phone;
            $this->email = $settings->email;
            $this->extract = $settings->extract;
            $this->description = $settings->description;
            $this->socialLinks = $settings->social_links ?? [];
            $this->executives = $settings->executives ?? [];
            $this->logoUrl = $settings->logo ? Storage::url($settings->logo) : null;
            $this->videoUrl = $settings->video ? Storage::url($settings->video) : null;
            $this->extract = $settings->extract;
            $this->imagePath = $settings->image ? Storage::url($settings->image) : null;
            $this->videoPath = $settings->video_img ? Storage::url($settings->video_img) : null;
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

        $this->resetNewExecutive();
    }
    public function removeExecutive($index)
    {
        unset($this->executives[$index]);
        $this->executives = array_values($this->executives);
    }
    public function save()
    {
        // Validar los datos generales
        $this->validate();

        try {
            $data = [
                'name' => $this->name,
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'address'=> $this->address,
                'phrase' => $this->phrase,
                'extract' => $this->extract,
                'social_links' => $this->socialLinks,
                'phone' => $this->phone,
                'email' => $this->email,
                'description' => $this->description,
                'executives' => $this->executives,
            ];

            if ($this->image) {
                $data['image'] = $this->image->store('image', 'public');
                $this->imagePath = Storage::url($data['image']);
            }
            if (isset($this->video_img)) {
                $data['video_img'] = $this->video_img->store('video-img', 'public');
                $this->videoPath = Storage::url($data['video_img']);
            }
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
        $this->reset(['name','logo','title','subtitle','executives','socialLinks','phone','email','description','imagePath','video','settingId','newExecutive']);
    }
    public function render()
    {
        return view('livewire.admin.settings-index');
    }
}
