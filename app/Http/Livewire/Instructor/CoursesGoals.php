<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use Livewire\Component;
use App\Models\Goal;

class CoursesGoals extends Component
{

    public $course, $goal, $name;

    protected $rules = [
        'goal.name' => 'required'
    ];

    public function mount(Course $course){
        $this->course = $course;
        $this->goal = new Goal();
    }

    public function render()
    {
        return view('livewire.instructor.courses-goals');
    }

    public function edit(Goal $goal){
        $this->goal = $goal;
    }

    public function update(){
        $this->validate();

        $this->goal->save();

        $this->goal = new Goal();

        $this->course = Course::find($this->course->id);
    }

    public function destroy(Goal $goal){
        $goal->delete();
        $this->course = Course::find($this->course->id);
    }

    public function store(){
        
        $rules = [
            'name' => 'required'
        ];

        $this->validate($rules);
        $this->course->goals()->create([
            'name' => $this->name
        ]);

        $this->reset('name');

        $this->course = Course::find($this->course->id);
    }
}