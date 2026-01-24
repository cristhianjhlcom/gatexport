# HubSpot Integration Documentation

## Overview

This application integrates with HubSpot CRM using the latest API v3 standards (2026) to capture and manage customer leads. The integration is separated into two distinct features:

1. **Contact Feature** - Captures general inquiries from contact forms
2. **Sales Feature** - Captures product inquiries and creates sales deals

---

## 1. Contact Feature

### Purpose
Captures leads from general contact forms and creates/updates contacts in HubSpot CRM.

### File Location
`app/Actions/Contact/CreateHubspotContact.php`

### How It Works

**When a user submits a contact form:**

1. Contact form data is validated (name, email, message)
2. The `CreateHubspotContact` action is invoked
3. API request is sent to HubSpot CRM v3 endpoint: `/crm/v3/objects/contacts`
4. A new contact is created with the following properties:
   - `email` - Contact's email address
   - `firstname` - Extracted from full name
   - `lastname` - Extracted from full name
   - `message` - User's inquiry message
   - `hs_lead_status` - Set to "NEW"
   - `lifecyclestage` - Set to "lead"

### Implementation

**Livewire Component:** `app/Livewire/Public/Contact/ContactForm.php`

```php
public function submit(CreateHubspotContact $createContact)
{
    $this->validate();
    
    // Send notifications and emails
    // ...
    
    try {
        $createContact($this->name, $this->email, $this->message);
    } catch (\Exception $e) {
        report($e);
    }
}
```

### API Request Example

```json
POST https://api.hubapi.com/crm/v3/objects/contacts
Authorization: Bearer YOUR_ACCESS_TOKEN
Content-Type: application/json

{
  "properties": {
    "email": "john.doe@example.com",
    "firstname": "John",
    "lastname": "Doe",
    "message": "I'm interested in your products",
    "hs_lead_status": "NEW",
    "lifecyclestage": "lead"
  }
}
```

### Response

Returns contact object with HubSpot contact ID and all properties.

---

## 2. Sales Feature

### Purpose
Captures product inquiries, creates contacts, and generates sales deals in HubSpot CRM with proper associations.

### File Location
`app/Actions/Sales/CreateHubspotDeal.php`

### How It Works

**When a user submits a product inquiry (buy button):**

1. Product inquiry data is validated (firstName, lastName, email, phone, quantity, notes)
2. The `CreateHubspotDeal` action is invoked
3. **Step 1: Contact Creation**
   - Creates or retrieves existing contact
   - API endpoint: `/crm/v3/objects/contacts`
   - Sets lifecycle stage to "opportunity"
4. **Step 2: Deal Creation**
   - Creates a new deal in HubSpot
   - API endpoint: `/crm/v3/objects/deals`
   - Deal name format: `{Product Name} - {First Name} {Last Name}`
   - Includes product details and pricing
5. **Step 3: Association**
   - Associates the contact with the deal
   - API endpoint: `/crm/v3/objects/contacts/{contactId}/associations/deals/{dealId}/deal_to_contact`

### Implementation

**Livewire Component:** `app/Livewire/Public/Products/BuyButton.php`

```php
public function createOrder(RequestOrderAction $create, CreateHubspotDeal $createDeal)
{
    $validated = $this->validate();
    
    try {
        $order = $create($this->product, $validated);
        
        // Send notifications and emails
        // ...
        
        try {
            $createDeal($this->product, $validated);
        } catch (\Exception $e) {
            report($e);
        }
    } catch (OrderCreationException $e) {
        // Handle errors
    }
}
```

### API Requests Flow

#### 1. Create Contact
```json
POST https://api.hubapi.com/crm/v3/objects/contacts
Authorization: Bearer YOUR_ACCESS_TOKEN
Content-Type: application/json

{
  "properties": {
    "email": "john.doe@example.com",
    "firstname": "John",
    "lastname": "Doe",
    "phone": "+1234567890",
    "hs_lead_status": "NEW",
    "lifecyclestage": "opportunity"
  }
}
```

#### 2. Create Deal
```json
POST https://api.hubapi.com/crm/v3/objects/deals
Authorization: Bearer YOUR_ACCESS_TOKEN
Content-Type: application/json

{
  "properties": {
    "dealname": "Premium Widget - John Doe",
    "dealstage": "qualifiedtobuy",
    "pipeline": "default",
    "amount": 1500.00,
    "closedate": 1738368000000,
    "description": "Product Inquiry Details:\n\nProduct: Premium Widget\nQuantity: 5\nCustomer Notes: Need bulk discount\nPhone: +1234567890"
  }
}
```

#### 3. Associate Contact with Deal
```http
PUT https://api.hubapi.com/crm/v3/objects/contacts/{contactId}/associations/deals/{dealId}/deal_to_contact
Authorization: Bearer YOUR_ACCESS_TOKEN
```

### Response

Returns object containing both contact and deal information:

```php
[
    'contact' => [
        'id' => '12345',
        'properties' => [...],
        'createdAt' => '...',
        'updatedAt' => '...'
    ],
    'deal' => [
        'id' => '67890',
        'properties' => [...],
        'createdAt' => '...',
        'updatedAt' => '...'
    ]
]
```

---

## Configuration

### Environment Variables

Add to your `.env` file:

```env
HUBSPOT_ACCESS_KEY=your_private_app_access_token
HUBSPOT_SECRET_KEY=your_secret_key
```

### HubSpot Setup Requirements

1. **Create a Private App** in HubSpot
   - Navigate to Settings → Integrations → Private Apps
   - Click "Create a private app"
   - Name: "Gate Export Integration"

2. **Set Required Scopes:**
   - `crm.objects.contacts.write`
   - `crm.objects.contacts.read`
   - `crm.objects.deals.write`
   - `crm.objects.deals.read`

3. **Get Access Token:**
   - Copy the access token
   - Add to `.env` as `HUBSPOT_ACCESS_KEY`

---

## Error Handling

Both features include comprehensive error handling:

- **Graceful Failures**: If HubSpot API fails, the user experience is not affected
- **Error Logging**: All exceptions are logged using `report()`
- **Duplicate Contacts**: The Sales feature handles existing contacts gracefully

---

## Testing

### Test Contact Feature
1. Submit a contact form on the public site
2. Check HubSpot → Contacts
3. Verify new contact with "lead" lifecycle stage

### Test Sales Feature
1. Click "Buy" on a product page
2. Fill out the inquiry form
3. Check HubSpot → Contacts (should show "opportunity" stage)
4. Check HubSpot → Deals (should show new deal)
5. Verify contact is associated with the deal

---

## Benefits of 2026 API v3 Standard

1. **RESTful Architecture**: Clean, predictable endpoints
2. **Better Performance**: Optimized for modern applications
3. **Enhanced Data Model**: Improved property management
4. **Association API**: Direct object relationships
5. **Batch Operations**: Support for bulk operations (future enhancement)

---

## Future Enhancements

- Implement webhook listeners for deal updates
- Add batch contact creation for newsletter signups
- Create custom pipeline stages
- Sync order status back to HubSpot deals
- Add analytics tracking for conversion rates
