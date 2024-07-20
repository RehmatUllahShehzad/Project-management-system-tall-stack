<?php

namespace App\Http\Livewire\Admin\System\Team;

use App\Http\Livewire\Traits\CanDeleteRecord;
use App\Http\Livewire\Traits\Notifies;
use App\Http\Livewire\Traits\ResetsPagination;
use App\Mail\InvitationMail;
use App\Models\Admin\Invite;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class TeamShowController extends TeamAbstract
{
    use WithPagination;
    use ResetsPagination;
    use CanDeleteRecord;
    use Notifies;

    public string $search = '';

    public string $showTrashed = '';

    public $inviteEmail;

    public function render(): View
    {
        return $this->view('admin.system.team.team-show-controller', function (View $view) {
            $view->with('teamUsers', $this->getTeamsUsers());
        });
    }

    /**
     * Define the validation rules.
     *
     * @return array<mixed>
     */
    protected function rules()
    {
        return [
            'team.name' => 'required|string|max:30|unique:'.get_class($this->team).',name,'.$this->team->id,
        ];
    }

    public function update(): void
    {
        $this->validate();

        $this->team->save();

        $this->notify(trans('notifications.teams.updated'));
    }

    public function delete(): void
    {
        $this->team->delete();

        $this->notify(trans('notifications.team.deleted'), 'admin.system.team.index');
    }

    /**
     * return field to verify for delete
     */
    public function getCanDeleteConfirmationField(): string
    {
        return $this->team->name;
    }


    /**
     * To send invitation email
     */
    public function sendInvitationEmail()
    {
        $this->validate([
            'inviteEmail' => 'required|email|max:50'
        ]);

        //generate token for invite
        do {
            $token = Str::random();
        }
        while (Invite::where('token', $token)->first());    

        //create an invite
        $invite = Invite::create([
            'team_id' => $this->team->id,
            'email' => $this->inviteEmail,
            'token' => $token
        ]);
        
        try {
            Mail::send(new InvitationMail($invite));
        } catch (\Exception $exception) {
            
            return $this->notify(trans('notifications.invitation.email.failed'), level: 'error');
        }

        $this->notify(trans('notifications.invitation.email.sent'));

        $this->inviteEmail = '';
    }

    public function getTeamsUsers()
    {
        return $this->team->users;
    }
    
}
