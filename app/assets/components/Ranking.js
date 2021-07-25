import React from "react";

export default function Ranking({ranking}) {
    let color = "text-green-500"
    if(ranking < 4) {
        color = "text-red-500"
    } else if(ranking < 7) {
        color = "text-yellow-500";
    }
    let halfStar = false;
    if(ranking % 2 !== 0) {
        halfStar = true;
    }
    let nbStar = parseInt(ranking/2);

    //console.log(nbStar, halfStar);

    const starList = [...Array(5)].map((x, i) => {
        if(i <= nbStar-1) {
            return (<Star color={color} key={i} />)
        } else if(halfStar) {
            halfStar = false;
            return (<HalfStar color={color} key={i} />)
        } else {
            return (<EmptyStar color={color} key={i} />)
        }
    });

    return (
        <div className="flex flex-row flew-wrap">
            {starList}
            <span className={'text-gray-600 ml-3'}>{ranking} / 10</span>
        </div>
    );
}

const Star = ({color}) => {
    return (
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" className={'h-5 w-5 '+color} fill={"currentColor"}>
            <path fill="currentColor" d="M17.56248,21.55957a1.00275,1.00275,0,0,1-.46531-.11475L12,18.76514,6.90283,21.44482a1.00019,1.00019,0,0,1-1.45117-1.0542l.97363-5.67578-4.12353-4.019a1.00033,1.00033,0,0,1,.5542-1.706l5.69873-.82813L11.103,2.99805a1.04173,1.04173,0,0,1,1.79394,0l2.54834,5.16357,5.69873.82813a1.00033,1.00033,0,0,1,.5542,1.706l-4.12353,4.019.97363,5.67578a1,1,0,0,1-.98586,1.169Z"/>
        </svg>
    )
}
const EmptyStar = ({color}) => {
    return (
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" className={'h-5 w-5 '+color}>
            <path fill="currentColor" d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68a1,1,0,0,0,.4,1,1,1,0,0,0,1.05.07L12,18.76l5.1,2.68a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.89l.72,4.19-3.76-2a1,1,0,0,0-.94,0l-3.76,2,.72-4.19a1,1,0,0,0-.29-.89l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z"/>
        </svg>
    )
}
const HalfStar = ({color}) => {
    return (
        <svg xmlns="http://www.w3.org/2000/svg" enableBackground="new 0 0 24 24" viewBox="0 0 24 24" className={'h-5 w-5 '+color}>
            <path fill="currentColor" d="M22,10.1c0.1-0.5-0.3-1.1-0.8-1.1l-5.7-0.8L12.9,3c-0.1-0.2-0.2-0.3-0.4-0.4C12,2.3,11.4,2.5,11.1,3L8.6,8.2L2.9,9C2.6,9,2.4,9.1,2.3,9.3c-0.4,0.4-0.4,1,0,1.4l4.1,4l-1,5.7c0,0.2,0,0.4,0.1,0.6c0.3,0.5,0.9,0.7,1.4,0.4l5.1-2.7l5.1,2.7c0.1,0.1,0.3,0.1,0.5,0.1v0c0.1,0,0.1,0,0.2,0c0.5-0.1,0.9-0.6,0.8-1.2l-1-5.7l4.1-4C21.9,10.5,22,10.3,22,10.1z M15.8,13.6c-0.2,0.2-0.3,0.6-0.3,0.9l0.7,4.2l-3.8-2c-0.1-0.1-0.3-0.1-0.5-0.1V5.7l1.9,3.8c0.1,0.3,0.4,0.5,0.8,0.5l4.2,0.6L15.8,13.6z"/>
        </svg>
    )
}