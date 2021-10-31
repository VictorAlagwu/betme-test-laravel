<template>
    <div class="flex flex-row max-w-screen">
        <div class="flex w-65 min-h-screen" id="side-bar">
            <!-- sidebar start -->
            <aside
                class="
                    flex flex-col
                    sidebar
                    min-h-screen
                    items-center
                    shadow
                    w-65
                "
            >
                <div
                    class="
                       
                        top-10
                        left-0
                        w-70
                        bg-white
                        h-full
                        border-r
                    "
                >
                    <div
                        class="flex items-center justify-center h-auto border-b"
                    >
                        <h4>BetMe</h4>
                    </div>
                    <div class="overflow-y-auto overflow-x-hidden flex-grow">
                        <p
                            class="
                                p-3
                                cursor-pointer
                                text-sm
                                font-bold
                                tracking-wide
                                text-gray-500
                            "
                            @click.prevent="currentView = 'upcoming'"
                        >
                            View Upcoming Games
                        </p>
                        <ul class="flex flex-col py-4 space-y-1">
                            <li
                                class="px-5"
                                v-for="(sport, key, index) in groupedSports"
                                :key="index"
                            >
                                <div class="items-center h-auto">
                                    <p
                                        class="
                                            text-sm
                                            font-bold
                                            tracking-wide
                                            text-gray-500
                                        "
                                    >
                                        {{ key }}
                                    </p>
                                    <ul class="space-y-1">
                                        <li
                                            v-for="(item, idx) in sport"
                                            :key="idx"
                                        >
                                            <a
                                                href="#"
                                                class="
                                                    relative
                                                    flex flex-row
                                                    items-center
                                                    h-11
                                                    cursor-pointer
                                                    focus:outline-none
                                                    hover:bg-gray-50
                                                    text-gray-600
                                                    hover:text-gray-800
                                                    border-l-4
                                                    border-transparent
                                                    hover:border-indigo-500
                                                    pr-6
                                                "
                                                @click.prevent="
                                                    handleViewSport(item.id)
                                                "
                                            >
                                                <span
                                                    class="
                                                        ml-2
                                                        text-sm
                                                        tracking-wide
                                                        truncate
                                                    "
                                                    >{{ item.name }}</span
                                                >
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
        <div class="flex flex-col flex-1 flex-grow content-start w-11/12 p-2">
            <main class="flex w-full min-h-screen font-sans flex-col flex-1 m-3">
                <section v-if="currentView !== 'upcoming'">
                    <h3 class="font-bold p-2">
                        Live Games for {{ selectedSport.name }}
                    </h3>
                    <table class="table auto overflow-x-auto w-full">
                        <thead class="text-gray-600">
                            <tr class="bg-white border-b border-gray-300">
                                <th class="py-2 px-2 text-left">
                                    <div class="inline-flex items-center">
                                        <span class="inline-block mr-3"
                                            >League</span
                                        >
                                    </div>
                                </th>
                                <th class="py-2 px-2 text-left">
                                    <div class="inline-flex items-center">
                                        <span class="inline-block mr-3"
                                            >Home Team</span
                                        >
                                    </div>
                                </th>
                                <th class="py-2 px-2 text-left">
                                    <div class="inline-flex items-center">
                                        <span class="inline-block mr-3"
                                            >Commence Time</span
                                        >
                                    </div>
                                </th>
                                <th class="py-2 px-2 text-left">
                                    <div class="inline-flex items-center">
                                        <span class="inline-block mr-3"
                                            >Details</span
                                        >
                                    </div>
                                </th>
                                <th class="py-2 px-2 text-left">
                                    <div class="inline-flex items-center">
                                        <span class="inline-block mr-3"
                                            >Bookmakers</span
                                        >
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="
                                    border-b border-gray-300
                                    text-gray-600 text-xs
                                "
                                v-for="(game, idx) in currentSportGames"
                                :key="idx"
                            >
                                <td>{{ game.sport_nice }}</td>
                                <td>{{ game.home_team }}</td>
                                <td>
                                    {{ new Date(game.commence_time * 1000) }}
                                </td>
                                <td>
                                    <ul>
                                        <li
                                            v-for="(team, index) in game.teams"
                                            :key="index"
                                        >
                                            <span v-if="index === 0">
                                                {{ team }} vs
                                            </span>
                                            <span v-else> {{ team }} </span>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <li
                                            v-for="(site, index) in game.sites"
                                            :key="index"
                                        >
                                            <span> {{ site.site_nice }} </span>
                                            <span class="flex flex-row">
                                                <div
                                                    class="p-2 border-green-500 text-white rounded-md bg-green-600 hover:bg-green-700"
                                                    v-for="(odd, idx) in site
                                                        .odds.h2h"
                                                    :key="idx"
                                                >
                                                    {{ odd }}
                                                </div>
                                            </span>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="pt-3" v-if="currentView === 'upcoming'">
                    <h3 class="font-bold p-2">Upcoming Games</h3>
                    <table class="table auto overflow-x-auto w-full">
                        <thead class="text-gray-600">
                            <tr class="bg-white border-b border-gray-300">
                                <th class="py-2 px-2 text-left">
                                    <div class="inline-flex items-center">
                                        <span class="inline-block mr-3"
                                            >League</span
                                        >
                                    </div>
                                </th>
                                <th class="py-2 px-2 text-left">
                                    <div class="inline-flex items-center">
                                        <span class="inline-block mr-3"
                                            >Home Team</span
                                        >
                                    </div>
                                </th>
                                <th class="py-2 px-2 text-left">
                                    <div class="inline-flex items-center">
                                        <span class="inline-block mr-3"
                                            >Commence Time</span
                                        >
                                    </div>
                                </th>
                                <th class="py-2 px-2 text-left">
                                    <div class="inline-flex items-center">
                                        <span class="inline-block mr-3"
                                            >Details</span
                                        >
                                    </div>
                                </th>
                                <th class="py-2 px-2 text-left">
                                    <div class="inline-flex items-center">
                                        <span class="inline-block mr-3"
                                            >Bookmakers</span
                                        >
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="
                                    border-b border-gray-300
                                    text-gray-600 text-xs
                                "
                                v-for="(game, idx) in upcomingGames"
                                :key="idx"
                            >
                                <td>{{ game.sport_nice }}</td>
                                <td>{{ game.home_team }}</td>
                                <td>
                                    {{ new Date(game.commence_time * 1000).toLocaleTimeString("en-GB") }}
                                </td>
                                <td>
                                    <ul>
                                        <li
                                            v-for="(team, index) in game.teams"
                                            :key="index"
                                        >
                                            <span v-if="index === 0">
                                                {{ team }} vs
                                            </span>
                                            <span v-else> {{ team }} </span>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <li
                                            v-for="(site, index) in game.sites"
                                            :key="index"
                                        >
                                            <span> {{ site.site_nice }} </span>
                                            <span class="flex flex-row">
                                                <div
                                                    class="p-2 border-green-500 text-white rounded-md bg-green-600 hover:bg-green-700"
                                                    v-for="(odd, idx) in site
                                                        .odds.h2h"
                                                    :key="idx"
                                                >
                                                    {{ odd }}
                                                </div>
                                            </span>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>
</template>

<script>
import { groupBy } from "lodash";

export default {
    name: "Home",
    data() {
        return {
            sports: [],
            upcomingGames: [],
            currentSportGames: [],
            selectedSport: {},
            currentView: "upcoming",
        };
    },
    computed: {
        groupedSports() {
            return groupBy(this.sports, (sport) => sport.group);
        },
    },
    created() {
        this.handleFetchSports();
        this.handleFetchUpcomingGame();
    },
    methods: {
        async handleFetchSports() {
            try {
                let url = "http://127.0.0.1:8000/api/v1/sports";
                let response = await this.axios.get(url);
                if (response.data?.data) {
                    let sports = response.data?.data.map((sport) => {
                        let value = JSON.parse(sport.meta);
                        sport.group = value.group;
                        sport.details = value.details;
                        return sport;
                    });
                    this.sports = sports;
                }
            } catch (error) {
                console.log("Error: " + error.message);
            }
        },
        async handleFetchUpcomingGame() {
            try {
                let url =
                    "http://127.0.0.1:8000/api/v1/sports/games?type=upcoming";
                let response = await this.axios.get(url);
                if (response.data?.data) {
                    this.upcomingGames = response.data?.data;
                }
            } catch (error) {
                console.log("Error: " + error.message);
            }
        },
        async handleFetchSelectedSportGames(id) {
            try {
                let url = `http://127.0.0.1:8000/api/v1/sports/games/${id}`;
                let response = await this.axios.get(url);
                if (response.data?.data) {
                    this.currentSportGames = response.data?.data;
                }
            } catch (error) {
                console.log("Error: " + error.message);
            }
        },
        async handleViewSport(id) {
            try {
                this.currentView = "live-sport-view";
                let sport = this.sports.find((sport) => sport.id === id);
                this.selectedSport = sport;
                this.handleFetchSelectedSportGames(id);
            } catch (error) {
                this.currentView = "upcoming";
            }
        },
    },
};
</script>
