<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

use App\Models\Scopes\OrganizationScope;


class Invoice extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_number',
        'customer_id',
        'organization_id',
        'invoice_date',
        'total_amount',
        'status',
        'paid_amount',
        'currency',
        'due_date',
        'notes',
        'line_items',
        'payment_method',
        'billing_address',
        'shipping_address',
        'is_taxable',
        'tax_amount',
        'discount_amount',
        'reference',
    ];

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
