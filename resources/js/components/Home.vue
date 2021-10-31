<template>
    <div class="container p-4">
        <div
            class="
                min-h-screen
                flex flex-col flex-auto flex-shrink-0
                antialiased
                bg-gray-50
                text-gray-800
            "
        >
            <div
                class="
                    fixed
                    flex flex-col
                    top-0
                    left-0
                    w-64
                    bg-white
                    h-full
                    border-r
                "
            >
                <div class="flex items-center justify-center h-auto border-b">
                    <h4>BetMe</h4>
                </div>
                <div class="overflow-y-auto overflow-x-hidden flex-grow">
                    <ul class="flex flex-col py-4 space-y-1">
                        <li
                            class="px-5"
                            v-for="(sport, key, index) in sports"
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
                                    <li v-for="(item, idx) in sport" :key="idx">
                                        <a
                                            href="#"
                                            class="
                                                relative
                                                flex flex-row
                                                items-center
                                                h-11
                                                focus:outline-none
                                                hover:bg-gray-50
                                                text-gray-600
                                                hover:text-gray-800
                                                border-l-4 border-transparent
                                                hover:border-indigo-500
                                                pr-6
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

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Group</th>
                        <th>Details</th>
                        <!-- <th>Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(sport, key, idx) in sports" :key="idx">
                        <td>{{ key }}</td>
                        <td>vibe</td>
                        <td>IIWIW</td>
                        <td>Wer</td>
                    </tr>
                </tbody>
            </table>
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
        };
    },
    created() {
        this.handleFetchSports();
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
                    this.sports = groupBy(sports, (sport) => sport.group);
                }
            } catch (error) {
                console.log("Error: " + error.message);
            }
        },
        async handleFetchUpcomingGame() {
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
                    this.sports = groupBy(sports, (sport) => sport.group);
                }
            } catch (error) {
                console.log("Error: " + error.message);
            }
        },
    },
};
</script>
