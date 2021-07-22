import React from "react";

export default function Ranking({ranking}) {
    let color = "green"
    if(ranking < 4) {
        color = "red"
    } else if(ranking < 7) {
        color = "yellow";
    }
    return (
        <div className="w-1/2">
            <span className={'font-bold text-' + color + '-500'}>{ranking} / 10</span>
        </div>
    );
}