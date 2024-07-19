<?php

namespace App\Livewire;

use App\Models\CustomerInformation;
use App\Models\Post;
use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateAccount extends Component implements HasForms
{
    use InteractsWithForms;

    public $firstname, $lastname, $phone_number, $address, $email, $password, $confirm_password;
    public function render()
    {
        return view('livewire.create-account');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Information')
                    ->description('Please enter all required fields.')
                    ->schema([
                        TextInput::make('firstname')
                            ->required(),
                        TextInput::make('lastname')
                            ->required(),
                        TextInput::make('phone_number')
                            ->required(),
                        TextInput::make('address')
                            ->required(),

                    ])->columns(2),
                Section::make('Account Information')
                    ->description('Please enter all required fields.')
                    ->schema([
                        TextInput::make('email')->email()
                        ->required(),
                        TextInput::make('password')->password()
                            ->required(),
                        TextInput::make('confirm_password')->password()->same('password')
                            ->required(),

                    ])->columns(2),

            ]);

    }

    public function submit(){
        sleep(1);
        $user = User::create([
            'name' => $this->firstname. ' ' . $this->lastname,
            'email' => $this->email,
            'password' => $this->password,
            'user_type' => 'customer'
        ]);

        CustomerInformation::create([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'address' => $this->address,
            'contact' => $this->phone_number,
            'user_id' => $user->id,
        ]);

        return redirect()->route('dashboard');
    }
}
