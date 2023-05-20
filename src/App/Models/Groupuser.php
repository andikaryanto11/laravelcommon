<?php

namespace LaravelCommon\App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupuser extends Model
{
    use HasFactory;
    use TraitModel;

    /**
     *
     * @return BelongsToMany
     */
    protected function scopes()
    {
        return $this->belongsToMany(Scope::class, 'groupuser_scopes');
    }

    /**
     *
     * @return Collection
     */
    public function getScopes()
    {
        return $this->scopes()->get();
    }

    /**
     *
     * @return Collection
     */
    public function setScopes(Collection $scopes)
    {
        return $this->scopes()->sync($scopes);
    }

    /**
     *
     * @param Scope $scope
     * @return Groupuser
     */
    public function addScope(Scope $scope): Groupuser
    {
        $this->scopes()->attach($scope);
        return $this;
    }

    /**
     *
     * @param Scope $scope
     * @return Groupuser
     */
    public function removeScope(Scope $scope): Groupuser
    {
        $this->scopes()->detach($scope);
        return $this;
    }

    /**
     * @return string
     */
    public function getGroupName(): string
    {
        return $this->group_name;
    }

    /**
     *
     * @param string $groupname
     * @return Groupuser
     */
    public function setGroupName(string $groupname): Groupuser
    {
        $this->group_name = $groupname;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     *
     * @param string|null $description
     * @return Groupuser
     */
    public function setDescription(?string $description): Groupuser
    {
        $this->description = $description;
        return $this;
    }
}
