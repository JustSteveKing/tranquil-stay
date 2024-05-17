<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * @property-read Form $form
 */
final class LoginForm extends Component implements HasForms
{
    use InteractsWithForms;

    public array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make(name: 'email')->label(label: 'Email Address')->required()->email()->maxLength(255),
            TextInput::make(name: 'password')->label(label: 'Password')->required()->password()->maxLength(255)->revealable(),
        ])->statePath(
            path: 'data',
        );
    }

    public function submit(AuthManager $auth): void
    {
        $auth->attempt(credentials: $this->form->getState());

        $this->redirect(
            url: route('pages:home'),
        );
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.auth.login-form',
        );
    }
}
