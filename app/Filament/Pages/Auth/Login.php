<?php


namespace App\Filament\Pages\Auth;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;

class Login extends \Filament\Pages\Auth\Login
{


    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                        $this->getForgotPasswordFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }


    protected function getForgotPasswordFormAction(): Action
    {
        return Action::make('forgot_password')
            ->label('Forgot Password?')
            ->url(route('password.request'));
    }

    protected function getForgotPasswordFormComponent(): Component
    {
        return TextInput::make('forgot_password_email')
            ->label('Forgot Password Email')
            ->email()
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getFormActions(): array
    {
        return [
            $this->getForgotPasswordFormAction(),
            $this->getAuthenticateFormAction(),
        ];
    }
}
