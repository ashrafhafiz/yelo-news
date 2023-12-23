<?php

namespace App\Filament\Resources\CommentResource\Widgets;

use App\Filament\Resources\CommentResource;
use Filament\Tables;
use App\Models\Comment;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestCommentsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Comment::latest()->take(5),
                Comment::orderBy('created_at', 'desc')->limit(5),
            )
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('author.name')->sortable()->searchable(),
                TextColumn::make('post.title')->sortable()->searchable(),
                TextColumn::make('body')->sortable()->searchable(),
            ])
            ->actions([
                Action::make('Approve')
                    ->url(fn (Comment $comment): string => CommentResource::getUrl('edit', ['record' => $comment]))
            ]);
    }
}
