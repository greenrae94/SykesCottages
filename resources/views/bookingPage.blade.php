<form action="/search" method="GET">
    <div style="margin-bottom: 10px;">
        <input type="text" name="query" placeholder="Search properties">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="pets_allowed">Pets Allowed:</label>
        <input type="checkbox" name="pets_allowed" id="pets_allowed" value="1">
        <label for="near_beach">Near Beach:</label>
        <input type="checkbox" name="near_beach" id="near_beach" value="1">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="currently_available">Currently Available Only:</label>
        <input type="checkbox" name="currently_available" id="currently_available" value="1">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="min_beds">Minimum Beds:</label>
        <select name="min_beds" id="min_beds">
            @for ($i = 1; $i <= $maxBeds; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <label for="min_sleeps">Minimum Sleeping Rooms:</label>
        <select name="min_sleeps" id="min_sleeps">
            @for ($i = 1; $i <= $maxSleeps; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <button type="submit">Search</button>
</form>


<table>
    <thead>
        <tr>
            <th>Property Name</th>
            <th>Location</th>
            <th>Beds</th>
            <th>Sleeps</th>
            <th>Near Beach</th>
            <th>Accepts Pets</th>
            <th>Availability</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($properties as $property)
            <tr>
                <td>{{ $property->property_name }}</td>
                <td>{{ $property->location->location_name }}</td>
                <td>{{ $property->beds }}</td>
                <td>{{ $property->sleeps }}</td>
                <td>{{ $property->near_beach ? 'Yes' : 'No' }}</td>
                <td>{{ $property->accepts_pets ? 'Yes' : 'No' }}</td>
                <td>{{ $property->availability }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $properties->links() }}


<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
