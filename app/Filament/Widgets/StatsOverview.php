<?php
namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Articles', Article::count())
                ->description('All articles in the system')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),

            Stat::make('Published Articles', Article::where('status', 'published')->count())
                ->description('Currently published')
                ->descriptionIcon('heroicon-m-eye')
                ->color('primary'),

            Stat::make('Total Comments', Comment::count())
                ->description('All comments received')
                ->descriptionIcon('heroicon-m-chat-bubble-left')
                ->color('warning'),

            Stat::make('Pending Comments', Comment::where('status', 'pending')->count())
                ->description('Awaiting moderation')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger'),
        ];
    }
}
