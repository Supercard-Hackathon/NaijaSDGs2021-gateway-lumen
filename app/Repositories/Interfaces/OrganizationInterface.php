<?php

namespace App\Repositories\Interfaces;
use Illuminate\Http\Request;
use App\Models\Organization;

interface OrganizationInterface
{
    public function newOrganization(Request $request);

    public function getOrganizationByUserId($user_id);

    public function getOrganizationById($organization_id);

    public function getOrganizationBySlug($organization_slug);

    public function addUserToOrganization($user_id, $organization_id);
}