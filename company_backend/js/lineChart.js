

            let margin = { top: 20, right: 20, bottom: 60, left: 50 },
    
                width = 800 - margin.left - margin.right,
                height = 500 - margin.top - margin.bottom,
    
                xScale = d3.scale.ordinal().rangeRoundBands([0, width], 0.5),
                yScale = d3.scale.linear().range([height, 0]);
    
            //Axis
            let xAxis = d3.svg.axis()
                .scale(xScale)
                .orient('bottom');
    
            let yAxis = d3.svg.axis()
                .scale(yScale)
                .ticks(5)
                .orient('left')
                .tickSize(-width, 0)
                .tickPadding(10);
    
    
            let svg = d3.select('#reporting')
                .append('svg')
                .attr({
                    'width': width + margin.left + margin.right,
                    'height': height + margin.top + margin.bottom,
                })
                .style('background-color', '#fff')
                .append("g")
                .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
    
    
            d3.json('day-price.json', function (data) {
    
                xScale.domain(data.map(function (d) {
                    return d.day;
                }));
    
                yScale.domain([0, d3.max(data, function (d) {
                    return d.price;
                })]);
    
    
                //line
                let line = d3.svg.line()
                    .x(function (d) {
                        return xScale(d.day);
                    })
                    .y(function (d) {
                        return yScale(d.price);
                    })
    
    
                //Draw Axis
                svg.append("g")
                    .attr("class", "x axis")
                    .attr("transform", "translate(0, " + height + ")")
                    .call(xAxis)
                    .attr('fill', 'none')
                    .attr('stroke', '#252121')
                    .selectAll("text")
                    .style("text-anchor", "end")
                    .attr('fill', '#252121')
                    .attr("dx", "-0.5em")
                    .attr("dy", "-.55em")
                    .attr("y", 30)
                    .attr("transform", "rotate(-45)");
    
                svg.append("g")
                    .attr("class", "y axis")
                    .call(yAxis)
                    .attr('fill', 'none')
                    .attr('stroke', '#c0c0c0')
                    .selectAll('text')
                    .attr('fill', '#252121')
                    .attr('stroke', '#252121');
    
    
                //linearGradient
                var svgDefs = svg.append('defs');
    
                var mainGradient = svgDefs.append('linearGradient')
                    .attr('id', 'mainGradient')
                    .attr('gradientTransform', "rotate(-90)")
    
                mainGradient.append('stop')
                    .attr('stop-color', '#F72D33')
                    .attr('offset', '0%')
                mainGradient.append('stop')
                    .attr('stop-color', '#B82126')
                    .attr('offset', '40%')
                mainGradient.append('stop')
                    .attr('stop-color', '#aa1f23')
                    .attr('offset', '60%')
                mainGradient.append('stop')
                    .attr('stop-color', '#911A1E')
                    .attr('offset', '80%')
                mainGradient.append('stop')
                    .attr('stop-color', '#6B1316')
                    .attr('offset', '100%');
                //'#40340D'  '#7A6418' '#BD9926' '#E6BB2E'  '#D6AE33'  #876E1B 
    
                d3.select("linearGradient")
                    .transition()
                    .duration(2000)
                    .attr('gradientTransform', "rotate(90)")
                    .ease('poly', '2');
    
    
                //Draw Path
                svg.append('path')
                    .attr({
                        'd': line(data),
                        'stroke': 'url(#mainGradient)',
                        'stroke-width': '5px',
                        'fill': 'none'
                    })
                    .attr('transform', "translate(" + margin.right + "," + 0 + ")")
    
                    //讓轉角圓滑
                    .attr("stroke-linejoin", 'round')
    
                    //讓線段頭尾為圓角
                    .attr('stroke-linecap', 'round')
    
                    .attr('stroke-dasharray', 2000)
                    .attr('stroke-dashoffset', 2000)
                    .transition()
                    .duration(1000)
                    .attr('stroke-dashoffset', 0)
                    .ease('poly', '2');
            })
      