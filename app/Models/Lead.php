<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'company', 'whatsapp', 'email', 'phone', 'country',
        'source', 'requirement', 'status', 'assigned_to', 'priority',
        'estimated_value', 'notes',
    ];

    protected $casts = [
        'estimated_value' => 'decimal:2',
    ];

    /**
     * Pipeline stages in order.
     */
    public const STATUSES = [
        'new_lead' => 'New Lead',
        'contacted' => 'Contacted',
        'requirement_received' => 'Requirement Received',
        'quotation_sent' => 'Quotation Sent',
        'negotiation' => 'Negotiation',
        'advance_received' => 'Advance Received',
        'designer_assigned' => 'Designer Assigned',
        'design_in_progress' => 'Design In Progress',
        'quality_check' => 'Quality Check',
        'client_approval' => 'Client Approval',
        'final_payment' => 'Final Payment',
        'delivered' => 'Delivered',
        'completed' => 'Completed',
    ];

    public const SOURCES = [
        'manual' => 'Manual Entry',
        'whatsapp' => 'WhatsApp',
        'website' => 'Website',
        'meta_lead_ad' => 'Meta Lead Ad',
        'meta_click_to_whatsapp' => 'Click-to-WhatsApp',
        'referral' => 'Referral',
    ];

    public const PRIORITIES = [
        'low' => 'Low',
        'medium' => 'Medium',
        'high' => 'High',
        'urgent' => 'Urgent',
    ];

    // Relationships
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function activities()
    {
        return $this->hasMany(LeadActivity::class)->latest();
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeBySource($query, $source)
    {
        return $query->where('source', $source);
    }

    public function scopeAssignedTo($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }

    // Helpers
    public function getStatusLabelAttribute()
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function getSourceLabelAttribute()
    {
        return self::SOURCES[$this->source] ?? $this->source;
    }

    public function getPriorityLabelAttribute()
    {
        return self::PRIORITIES[$this->priority] ?? $this->priority;
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'new_lead' => 'primary',
            'contacted', 'requirement_received' => 'info',
            'quotation_sent', 'negotiation' => 'warning',
            'advance_received', 'designer_assigned', 'design_in_progress' => 'gold',
            'quality_check', 'client_approval' => 'purple',
            'final_payment', 'delivered' => 'success',
            'completed' => 'success',
            default => 'primary',
        };
    }

    public function getPriorityColorAttribute()
    {
        return match($this->priority) {
            'low' => 'info',
            'medium' => 'warning',
            'high' => 'danger',
            'urgent' => 'danger',
            default => 'primary',
        };
    }
}
