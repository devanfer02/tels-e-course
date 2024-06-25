#!/bin/bash

# DONT CHANGE THE ORDER
mcrs=(
    Course
    SubCourse
    Evaluation
    Question
    Option
)

models=(
    Role
    Grade
    Major
    Curriculum
    QuestionCategory
    EvaluationCategory
)

models2=(
    SubCourseContent
    UserEnrollDetail
    UserSubCourseDetail
    DragNDrop
    Pilganda
)

echo "Starting create model and migration file..."
for model in "${models[@]}"; do
    echo "Running create migration file for model $model"
    php artisan make:model $model -m
    echo "Creating model $model done"
done

echo "Starting create model, migration and controller file..."
for model in "${mcrs[@]}"; do
    echo "Running create mcr files for model $model"
    php artisan make:model $model -mcr
    echo "Creating model $model done"
done

echo "Starting create model and migration file..."
for model in "${models2[@]}"; do
    echo "Running create migration file for model $model"
    php artisan make:model $model -m
    echo "Creating model $model done"
done
