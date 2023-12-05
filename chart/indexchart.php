<?php
	
	// January
	$janrevty = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 1 and YEAR(present_readdate)=YEAR(now())");
	$janrevly = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 1 and YEAR(present_readdate)=YEAR(now())-1");
	$janrty = $janrevty->fetch_assoc();
	$janrly = $janrevly->fetch_assoc();
	// February
	$febrevty = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 2 and YEAR(present_readdate)=YEAR(now())");
	$febrevly = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 2 and YEAR(present_readdate)=YEAR(now())-1");
	$febrty = $febrevty->fetch_assoc();
	$febrly = $febrevly->fetch_assoc();
	// March
	$marrevty = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 3 and YEAR(present_readdate)=YEAR(now())");
	$marrevly = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 3 and YEAR(present_readdate)=YEAR(now())-1");
	$marrty = $marrevty->fetch_assoc();
	$marrly = $marrevly->fetch_assoc();
	// April
	$aprrevty = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 4 and YEAR(present_readdate)=YEAR(now())");
	$aprrevly = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 4 and YEAR(present_readdate)=YEAR(now())-1");
	$aprrty = $aprrevty->fetch_assoc();
	$aprrly = $aprrevly->fetch_assoc();
	// May
	$mayrevty = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 5 and YEAR(present_readdate)=YEAR(now())");
	$mayrevly = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 5 and YEAR(present_readdate)=YEAR(now())-1");
	$mayrty = $mayrevty->fetch_assoc();
	$mayrly = $mayrevly->fetch_assoc();
	// June
	$junrevty = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 6 and YEAR(present_readdate)=YEAR(now())");
	$junrevly = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 6 and YEAR(present_readdate)=YEAR(now())-1");
	$junrty = $junrevty->fetch_assoc();
	$junrly = $junrevly->fetch_assoc();
	// July
	$julrevty = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 7 and YEAR(present_readdate)=YEAR(now())");
	$julrevly = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 7 and YEAR(present_readdate)=YEAR(now())-1");
	$julrty = $julrevty->fetch_assoc();
	$julrly = $julrevly->fetch_assoc();
	// August
	$augrevty = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 8 and YEAR(present_readdate)=YEAR(now())");
	$augrevly = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 8 and YEAR(present_readdate)=YEAR(now())-1");
	$augrty = $augrevty->fetch_assoc();
	$augrly = $augrevly->fetch_assoc();
	// September
	$seprevty = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 9 and YEAR(present_readdate)=YEAR(now())");
	$seprevly = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 9 and YEAR(present_readdate)=YEAR(now())-1");
	$seprty = $seprevty->fetch_assoc();
	$seprly = $seprevly->fetch_assoc();
	// October
	$octrevty = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 10 and YEAR(present_readdate)=YEAR(now())");
	$octrevly = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 10 and YEAR(present_readdate)=YEAR(now())-1");
	$octrty = $octrevty->fetch_assoc();
	$octrly = $octrevly->fetch_assoc();
	// November
	$novrevty = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 11 and YEAR(present_readdate)=YEAR(now())");
	$novrevly = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 11 and YEAR(present_readdate)=YEAR(now())-1");
	$novrty = $novrevty->fetch_assoc();
	$novrly = $novrevly->fetch_assoc();
	// December
	$decrevty = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 12 and YEAR(present_readdate)=YEAR(now())");
	$decrevly = $conn->query("SELECT SUM(total_pay) AS tp, SUM(pchange) AS pc FROM billings where MONTH(present_readdate) = 12 and YEAR(present_readdate)=YEAR(now())-1");
	$decrty = $decrevty->fetch_assoc();
	$decrly = $decrevly->fetch_assoc();
?>
<script>
! function(l) {
    "use strict";

    function t() {
        this.$body = l("body"), this.charts = []
    }
    t.prototype.respChart = function(e, r, a, o) {
        var n = Chart.controllers.bar.prototype.draw;
        Chart.controllers.bar = Chart.controllers.bar.extend({
            draw: function() {
                n.apply(this, arguments);
                var t = this.chart.chart.ctx,
                    e = t.fill;
                t.fill = function() {
                    t.save(), t.shadowColor = "rgba(0,0,0,0.01)", t.shadowBlur = 20, t.shadowOffsetX = 4, t.shadowOffsetY = 5, e.apply(this, arguments), t.restore()
                }
            }
        }), Chart.defaults.global.defaultFontColor = "#8391a2", Chart.defaults.scale.gridLines.color = "#8391a2";
        var i = e.get(0).getContext("2d"),
            s = l(e).parent();
        return function() {
            var t;
            switch (e.attr("width", l(s).width()), r) {
                case "Line":
                    t = new Chart(i, {
                        type: "line",
                        data: a,
                        options: o
                    });
                    break;
                case "Doughnut":
                    t = new Chart(i, {
                        type: "doughnut",
                        data: a,
                        options: o
                    });
                    break;
                case "Pie":
                    t = new Chart(i, {
                        type: "pie",
                        data: a,
                        options: o
                    });
                    break;
                case "Bar":
                    t = new Chart(i, {
                        type: "bar",
                        data: a,
                        options: o
                    });
                    break;
                case "Radar":
                    t = new Chart(i, {
                        type: "radar",
                        data: a,
                        options: o
                    });
                    break;
                case "PolarArea":
                    t = new Chart(i, {
                        data: a,
                        type: "polarArea",
                        options: o
                    })
            }
            return t
        }()
    }, t.prototype.initCharts = function() {
        var t, e;
        0 < l("#high-performing-product").length && ((t = document.getElementById("high-performing-product").getContext("2d").createLinearGradient(0, 500, 0, 150)).addColorStop(0, "#fa5c7c"), t.addColorStop(1, "#727cf5"), e = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "<?php echo date('Y'); ?>",
                backgroundColor: t,
                borderColor: t,
                hoverBackgroundColor: t,
                hoverBorderColor: t,
                data: [
					  <?php echo $janrty['tp'] - $janrty['pc']; ?>
					, <?php echo $febrty['tp'] - $febrty['pc']; ?>
					, <?php echo $marrty['tp'] - $marrty['pc']; ?>
					, <?php echo $aprrty['tp'] - $aprrty['pc']; ?>
					, <?php echo $mayrty['tp'] - $mayrty['pc']; ?>
					, <?php echo $junrty['tp'] - $junrty['pc']; ?>
					, <?php echo $julrty['tp'] - $julrty['pc']; ?>
					, <?php echo $augrty['tp'] - $augrty['pc']; ?>
					, <?php echo $seprty['tp'] - $seprty['pc']; ?>
					, <?php echo $octrty['tp'] - $octrty['pc']; ?>
					, <?php echo $novrty['tp'] - $novrty['pc']; ?>
					, <?php echo $decrty['tp'] - $decrty['pc']; ?>
					  ]
            }, {
                label: "<?php echo date('Y', strtotime('-1 year')); ?>",
                backgroundColor: "#e3eaef",
                borderColor: "#e3eaef",
                hoverBackgroundColor: "#e3eaef",
                hoverBorderColor: "#e3eaef",
                data: [
					  <?php echo $janrly['tp'] - $janrly['pc']; ?>
					, <?php echo $febrly['tp'] - $febrly['pc']; ?>
					, <?php echo $marrly['tp'] - $marrly['pc']; ?>
					, <?php echo $aprrly['tp'] - $aprrly['pc']; ?>
					, <?php echo $mayrly['tp'] - $mayrly['pc']; ?>
					, <?php echo $junrly['tp'] - $junrly['pc']; ?>
					, <?php echo $julrly['tp'] - $julrly['pc']; ?>
					, <?php echo $augrly['tp'] - $augrly['pc']; ?>
					, <?php echo $seprly['tp'] - $seprly['pc']; ?>
					, <?php echo $octrly['tp'] - $octrly['pc']; ?>
					, <?php echo $novrly['tp'] - $novrly['pc']; ?>
					, <?php echo $decrly['tp'] - $decrly['pc']; ?>
					  ]
            }]
        }, [].push(this.respChart(l("#high-performing-product"), "Bar", e, {
            maintainAspectRatio: !1,
            legend: {
                display: !1
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: !1,
                        color: "rgba(0,0,0,0.05)"
                    },
                    stacked: !1,
                    ticks: {
                        stepSize: 10000
                    }
                }],
                xAxes: [{
                    barPercentage: 1,
                    categoryPercentage: .5,
                    stacked: !1,
                    gridLines: {
                        color: "rgba(0,0,0,0.01)"
                    }
                }]
            }
        })))
    }, t.prototype.init = function() {
        var e = this;
        Chart.defaults.global.defaultFontFamily = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif', e.charts = this.initCharts(), l(window).on("resize", function(t) {
            l.each(e.charts, function(t, e) {
                try {
                    e.destroy()
                } catch (t) {}
            }), e.charts = e.initCharts()
        })
    }, l.Profile = new t, l.Profile.Constructor = t
}(window.jQuery),
function() {
    "use strict";
    window.jQuery.Profile.init()
}();
</script>